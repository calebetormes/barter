<?php

namespace App\Filament\Resources;

use App\Models\User;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    // Define qual modelo será usado por esse resource
    protected static ?string $model = User::class;

    // Ícone e rótulos no menu do painel
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Usuários';
    protected static ?string $modelLabel = 'Usuário';

    /**
     * Formulário de criação/edição do usuário
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            // Campo nome
            Forms\Components\TextInput::make('name')
                ->label('Nome')
                ->required(),

            // Campo email
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),

            // Campo senha (só exigido na criação)
            Forms\Components\TextInput::make('password')
                ->label('Senha')
                ->password()
                ->required(fn($context) => $context === 'create')
                ->dehydrateStateUsing(fn($state) => !empty($state) ? bcrypt($state) : null)
                ->dehydrated(fn($state) => filled($state)),

            // Select com os papéis de acesso (roles)
            Forms\Components\Select::make('roles_id')
                ->label('Perfil de Acesso')
                ->relationship('role', 'name')
                ->required(),
        ]);
    }

    /**
     * Tabela de listagem dos usuários
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Nome do usuário
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),

                // Email
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                // Papel do usuário (role.name)
                Tables\Columns\TextColumn::make('role.name')
                    ->label('Perfil'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /**
     * Define o que cada tipo de usuário pode visualizar
     */
    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        // Administrador vê tudo
        if ($user->isAdmin()) {
            return parent::getEloquentQuery();
        }

        // Gerente Nacional vê todos os usuários
        if ($user->hasRole('Gerente Nacional')) {
            return parent::getEloquentQuery();
        }

        // Gerente Comercial vê os vendedores que ele gerencia + ele mesmo
        if ($user->hasRole('Gerente Comercial')) {
            return parent::getEloquentQuery()
                ->whereIn('id', function ($query) use ($user) {
                    $query->select('vendedor')
                        ->from('vendedor_gerente')
                        ->where('gerente', $user->id);
                })->orWhere('id', $user->id);
        }

        // Vendedor vê apenas a si mesmo
        return parent::getEloquentQuery()->where('id', $user->id);
    }

    /**
     * Relacionamentos adicionais no resource (não utilizados por enquanto)
     */
    public static function getRelations(): array
    {
        return [];
    }

    /**
     * Páginas que fazem parte do resource
     */
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
