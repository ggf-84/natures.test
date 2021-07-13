<?php

namespace App;

use App\Presenters\DonationPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Terranet\Presentable\PresentableInterface;
use Terranet\Presentable\PresentableTrait;

class Donation extends Model implements PresentableInterface
{
    use PresentableTrait;

    const TYPE_PERSONAL = 'personal';
    const TYPE_CORPORATE = 'corporate';

    const PAYMENT_PAYPAL = 'paypal';
    const PAYMENT_BITCOIN = 'bitcoin';

    const RECURRING_MONTHLY = 'monthly';
    const RECURRING_YEARLY = 'yearly';

    const DEDICATE_HONOR = 'in_honor';
    const DEDICATE_MEMORY = 'in_memory';

    protected $fillable = [
        'name',
        'country_id',
        'city',
        'address',
        'phone',
        'email',
        'comment',
        'type',
        'payment_type',
        'amount',
        'trees',
        'recurring',
        'dedicated',
        'dedicate_type',
        'dedicate_name',
        'dedicate_message',
    ];

    protected $presenter = DonationPresenter::class;

    public static function typesList($addEmpty = false)
    {
        $items = [
            self::TYPE_PERSONAL => trans('donations.types.' . self::TYPE_PERSONAL),
            self::TYPE_CORPORATE => trans('donations.types.' . self::TYPE_CORPORATE),
        ];

        return $addEmpty ? ['' => '--Any--'] + $items : $items;
    }

    public static function recurringTypesList()
    {
        return [
            self::RECURRING_MONTHLY,
            self::RECURRING_YEARLY,
        ];
    }

    public static function dedicateTypesList()
    {
        return [
            self::DEDICATE_HONOR => trans('donations.dedicate.' . self::DEDICATE_HONOR),
            self::DEDICATE_MEMORY => trans('donations.dedicate.' . self::DEDICATE_MEMORY),
        ];
    }

    public static function paymentTypesList($addEmpty = false)
    {
        $items = [
            self::PAYMENT_PAYPAL => self::PAYMENT_PAYPAL,
            //self::PAYMENT_BITCOIN => self::PAYMENT_BITCOIN,
        ];

        return $addEmpty ? ['' => '--Any--'] + $items : $items;
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeKeyword($query, $keyword = null)
    {
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('phone', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('city', 'like', "%{$keyword}%")
                    ->orWhere('address', 'like', "%{$keyword}%");
            });
        }

        return $query;
    }
}
