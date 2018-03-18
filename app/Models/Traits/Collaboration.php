<?php

namespace App\Models\Traits;

use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

trait Collaboration
{

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('is_owner', 'user_id', 'item_id', 'is_owner', 'role_id')
            ->withTimestamps();
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function isOwner(User $user)
    {
        foreach ($this->users as $member) {
            if ($member->id == $user->id = $member->is_owner) return true;
        }

        return false;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function isMember(User $user)
    {
        $userMembers = array_column($this->users->toArray(), 'id');

        return array_search($user->id, $userMembers) > -1;
    }

    /**
     * @param array $params
     */
    public function setCollaborators(array $params)
    {
        if (isset($params['users'])) {
            $collaborators = json_decode($params['users']);
            $userMembersId = array_column($this->users->toArray(), 'id');
            $ownerId = Auth::id();
            $insertOwner = true;
            $_collaborators = [];

            foreach ($collaborators as $collaborator) {
                if ($collaborator->id == $ownerId) $insertOwner = false;
                $_collaborators[$collaborator->id]['role_id'] = $collaborator->pivot->role_id;

                if (array_search($collaborator->id, $userMembersId) === false) {
                    $invitationToken = str_random(self::ITEM_TOKEN_LENGTH);
                    $_collaborators[$collaborator->id]['validation_token'] = $invitationToken;

                    $this->createAddCollaboratorEvent([
                        'model'            => $this,
                        'user_id'          => $collaborator->id,
                        'role_id'          => $collaborator->pivot->role_id,
                        'invitation_token' => $invitationToken,
                    ]);
                }
            }

            if ($insertOwner) $_collaborators[$ownerId] = [];

            $this->users()->sync($_collaborators);

            $this->load('users');
        }
    }
}
