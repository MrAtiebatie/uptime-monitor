<?php

namespace Spark;

use Illuminate\Contracts\Validation\Rule;

class ValidPlan implements Rule
{
    /**
     * The plan type.
     *
     * @var string
     */
    protected $type;

    /**
     * Create a new rule instance.
     *
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $plan = collect(config("spark.billables.$this->type.plans"))
            ->first(function ($plan) use ($value) {
                return (isset($plan['monthly_id']) && $plan['monthly_id'] == $value) ||
                       (isset($plan['yearly_id']) && $plan['yearly_id'] == $value);
            });

        return ! is_null($plan) && (! isset($plan['archived']) || ! $plan['archived']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The selected plan is invalid.');
    }
}
