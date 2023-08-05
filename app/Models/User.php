<?php

namespace App\Models;

use App\Constants\ProfileStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'dob',
        'user_type',
        'affiliate_code',
        'refer_affiliate_code',
        'refer_reward',
        'refer_reward_amount',
        'ssn',
        'password',
        'profile_status',
        'is_verification_requested',
        'mobile_verified_at',
        'is_agreement_accepted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'mobile' => 'string',
        'dob' => 'datetime',
        'user_type' => 'integer',
        'affiliate_code' => 'string',
        'refer_affiliate_code' => 'string',
        'refer_reward' => 'integer',
        'refer_reward_amount' => 'double',
        'ssn' => 'string',
        'profile_status' => 'integer',
        'is_verification_requested' => 'integer',
        'mobile_verified_at' => 'datetime',
        'is_agreement_accepted' => 'integer',
        'is_tc_accepted' => 'integer',
    ];

    public function recommendations(): HasMany
    {
        return $this->hasMany(User::class, 'refer_affiliate_code', 'affiliate_code')->where('profile_status',ProfileStatus::VERIFICATION_COMPLETED);
    }

    public function notAttends(): HasMany
    {
        return $this->hasMany(User::class, 'refer_affiliate_code', 'affiliate_code')->where('profile_status', '!=' ,ProfileStatus::VERIFICATION_COMPLETED);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // get photo id front attribute
    public function getPhotoIdFrontAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.user.photo_id_front'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    // get photo id back attribute
    public function getPhotoIdBackAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.user.photo_id_back'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    // get photo id selfie attribute
    public function getPhotoIdSelfieAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.user.photo_id_selfie'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function uploadFiles()
    {
        // check for photo id front
        if (request()->hasFile('photo_id_front')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.user.photo_id_front'))) {
                $this->clearMediaCollection(config('core.media_collection.user.photo_id_front'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('photo_id_front')
                ->toMediaCollection(config('core.media_collection.user.photo_id_front'));
        }

        // check for photo id back
        if (request()->hasFile('photo_id_back')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.user.photo_id_back'))) {
                $this->clearMediaCollection(config('core.media_collection.user.photo_id_back'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('photo_id_back')
                ->toMediaCollection(config('core.media_collection.user.photo_id_back'));
        }

        // check for photo id selfie
        if (request()->hasFile('photo_id_selfie')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.user.photo_id_selfie'))) {
                $this->clearMediaCollection(config('core.media_collection.user.photo_id_selfie'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('photo_id_selfie')
                ->toMediaCollection(config('core.media_collection.user.photo_id_selfie'));
        }
    }
}
