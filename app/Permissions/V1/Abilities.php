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

    public const CreateUser = 'user:create';
    public const UpdateUser = 'user:update';
    public const ReplaceUser = 'user:replace';
    public const DeleteUser = 'user:delete';

    public const UpdateOwnUser = 'user:own:update';
    public const ReplaceOwnUser = 'user:own:replace';
    public const DeleteOwnUser = 'user:own:delete';

    public static function getAbilities(User $user): array
    {
        // don´t assign token abilities to [*]
        if ($user->is_admin) {
            return [
                self::CreateTransaction,
                self::UpdateTransaction,
                self::ReplaceTransaction,
                self::DeleteTransaction,
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
                self::UpdateOwnUser,
                self::ReplaceOwnUser,
                self::DeleteOwnUser,
            ];
        }
    }


}
