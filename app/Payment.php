<?php

namespace App;

use App\Presenters\PaymentPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Terranet\Presentable\PresentableInterface;
use Terranet\Presentable\PresentableTrait;

class Payment extends Model implements PresentableInterface
{
    use PresentableTrait;

    protected $presenter = PaymentPresenter::class;

    protected $fillable = [
        'donation_id',
        'amount',
        'status',
        'payment_date',
        'payment_id',
        'payer_id',
        'token',
    ];

    public static function availableStatuses($addEmpty = false)
    {
        $items = [
            'pending' => 'pending',
            'approved' => 'approved',
            'failed' => 'failed',
            'refunded' => 'refunded',
            'locked' => 'locked',
            'unlocked' => 'unlocked',
        ];

        return $addEmpty ? ['' => '--Any--'] + $items : $items;
    }

    public function donation(): BelongsTo
    {
        return $this->belongsTo(Donation::class);
    }

    public static function getByToken($token): Payment
    {
        return (new static)->where('token', $token)->first();
    }

    public function scopePaymentType($query, $type = null)
    {
        if ($type) {
            $query->join('donations', 'donations.id', '=', 'payments.donation_id')
                ->where('donations.payment_type', $type);
        }

        return $query;
    }

    public function scopeAmountFrom($query, $value = 0)
    {
        return $this->amountQuery($query, $value, '>=');
    }

    public function scopeAmountTo($query, $value = 0)
    {
        return $this->amountQuery($query, $value, '<=');
    }

    protected function amountQuery($query, $value, $operator)
    {
        $value = (float)$value;

        if ($value) {
            $query->where('payments.amount', $operator, $value);
        }

        return $query;
    }
}
