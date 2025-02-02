<?php

namespace App\Permissions\V1;

use App\Models\User;

final class Abilities {
    public const CreateTransaction = 'transaction:create';
    public const UpdateTransaction = 'transaction:update';
    public const ReplaceTransaction = 'transaction:replace';
    public const DeleteTransaction= 'transaction:delete';

    public const CreateOwnTransaction = 'transaction:own:create';
    public const UpdateOwnTransaction = 'transaction:own:update';
    public const ReplaceOwnTransaction = 'transaction:own:replace';
    public const DeleteOwnTransaction= 'transaction:own:delete';

    public const CreateTransactionType = 'transaction_type:create';
    public const UpdateTransactionType = 'transaction_type:update';
    public const ReplaceTransactionType = 'transaction_type:replace';
    public const DeleteTransactionType = 'transaction_type:delete';

    public const CreateUser = 'user:create';
    public const UpdateUser = 'user:update';
    public const ReplaceUser = 'user:replace';
    public const DeleteUser = 'user:delete';

    public const UpdateOwnUser = 'user:own:update';
    public const ReplaceOwnUser = 'user:own:replace';
    public const DeleteOwnUser = 'user:own:delete';

    public const CreateCategory = 'category:create';
    public const UpdateCategory = 'category:update';
    public const ReplaceCategory = 'category:replace';
    public const DeleteCategory = 'category:delete';

    public const UpdateOwnCategory = 'category:own:update';
    public const ReplaceOwnCategory = 'category:own:replace';
    public const DeleteOwnCategory = 'category:own:delete';
    public const CreateOnwCategory = 'category:own:create';

    public static function getAbilities(User $user): array
    {
        // don´t assign token abilities to [*]
        if ($user->is_admin) {
            return [
                self::CreateTransaction,
                self::UpdateTransaction,
                self::ReplaceTransaction,
                self::DeleteTransaction,
                self::CreateTransactionType,
                self::UpdateTransactionType,
                self::ReplaceTransactionType,
                self::DeleteTransactionType,
                self::CreateCategory,
                self::UpdateCategory,
                self::ReplaceCategory,
                self::DeleteCategory,
                self::CreateUser,
                self::UpdateUser,
                self::ReplaceUser,
                self::DeleteUser,
            ];
        } else {
            return [
                self::CreateOwnTransaction,
                self::UpdateOwnTransaction,
                self::DeleteOwnTransaction,
                self::ReplaceOwnTransaction,
                self::CreateOnwCategory,
                self::UpdateOwnCategory,
                self::ReplaceOwnCategory,
                self::DeleteOwnCategory,
                self::UpdateOwnUser,
                self::ReplaceOwnUser,
                self::DeleteOwnUser,
            ];
        }
    }
}
