<?php

namespace App\Permissions\V1;

use App\Models\User;

final class Abilities {
    public const CreateTransaction = 'transaction:create';
    public const UpdateTransaction = 'transaction:update';
    public const ReplaceTransaction = 'transaction:replace';
    public const DeleteTransaction= 'transaction:delete';

    public const UpdateOwnTransaction = 'transaction:own:update';
    public const DeleteOwnTransaction= 'transaction:own:delete';

    public const CreateUser = 'user:create';
    public const UpdateUser = 'user:update';
    public const ReplaceUser = 'user:replace';
    public const DeleteUser = 'user:delete';

    public static function getAbilities(User $user): array
    {
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
                self::CreateTransaction,
                self::UpdateOwnTransaction,
                self::DeleteOwnTransaction
            ];
        }
    }


}
