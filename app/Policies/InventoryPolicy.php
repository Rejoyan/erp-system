<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Inventory;

class InventoryPolicy
{
    /**
     * Determine whether the user can manage inventory (create, update, delete).
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function manageInventory(User $user)
    {
        // Allow access if the user is an admin or has specific permissions
        return $user->role === 'admin' || $user->hasPermissionTo('manage inventory');
    }

    /**
     * Determine whether the user can view any inventory items.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        // Allow all authenticated users to view the inventory list or users with specific permissions
        return $user->is_admin || $user->hasPermissionTo('view inventory');
    }

    /**
     * Determine whether the user can view the inventory item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Inventory  $inventory
     * @return bool
     */
    public function view(User $user, Inventory $inventory)
    {
        // Allow viewing of inventory items if the user is an admin or has permission
        return $user->is_admin || $user->hasPermissionTo('view inventory');
    }

    /**
     * Determine whether the user can create inventory items.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        // Allow users to create inventory if they are admins or have permission to create
        return $user->is_admin || $user->hasPermissionTo('create inventory');
    }

    /**
     * Determine whether the user can update the inventory item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Inventory  $inventory
     * @return bool
     */
    public function update(User $user, Inventory $inventory)
    {
        // Allow updating if the user is an admin or has permission
        return $user->is_admin || $user->hasPermissionTo('update inventory');
    }

    /**
     * Determine whether the user can delete the inventory item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Inventory  $inventory
     * @return bool
     */
    public function delete(User $user, Inventory $inventory)
    {
        // Allow deletion if the user is an admin or has permission
        return $user->is_admin || $user->hasPermissionTo('delete inventory');
    }
}
