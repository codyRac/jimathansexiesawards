<?php

namespace App\Models;

use Database\Factories\NominationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $nomination_number
 * @property string $nominator_name
 * @property string $nominator_email
 * @property string|null $nominator_x_handle
 * @property bool $self_nomination
 * @property string $nominee_name
 * @property string $nominee_x_handle
 * @property string|null $show_name
 * @property list<string> $categories
 * @property string $reason
 * @property string|null $links
 * @property list<string>|null $attachments
 * @property int $amount_due
 * @property string $payment_method
 * @property string|null $payment_reference
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable([
    'nomination_number',
    'nominator_name',
    'nominator_email',
    'nominator_x_handle',
    'self_nomination',
    'nominee_name',
    'nominee_x_handle',
    'show_name',
    'categories',
    'reason',
    'links',
    'attachments',
    'amount_due',
    'payment_method',
    'payment_reference',
    'status',
])]
class Nomination extends Model
{
    /** @use HasFactory<NominationFactory> */
    use HasFactory;

    public const string STATUS_PENDING = 'pending';

    public const string STATUS_VERIFIED = 'verified';

    protected static function booted(): void
    {
        static::created(function (Nomination $nomination) {
            $nomination->updateQuietly([
                'nomination_number' => sprintf('XIES-%s-%04d', $nomination->created_at?->format('Y') ?? now()->format('Y'), $nomination->id),
            ]);
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'self_nomination' => 'boolean',
            'categories' => 'array',
            'attachments' => 'array',
            'amount_due' => 'integer',
        ];
    }
}
