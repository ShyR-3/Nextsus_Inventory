<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $category
 * @property string|null $specification
 * @property int $stock
 * @property string $status
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Borrowing> $borrowings
 * @property-read int|null $borrowings_count
 * @property-read mixed $status_color
 * @property-read mixed $status_label
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset available()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset byCategory($category)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereSpecification($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereUpdatedAt($value)
 */
	class Asset extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int $asset_id
 * @property \Illuminate\Support\Carbon $borrow_date
 * @property \Illuminate\Support\Carbon|null $return_date
 * @property string $status
 * @property string|null $notes
 * @property string|null $location
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Asset $asset
 * @property-read mixed $status_badge
 * @property-read mixed $status_label
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing whereBorrowDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrowing whereUserId($value)
 */
	class Borrowing extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string $role
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $google_id
 * @property string|null $avatar
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

