<?php

return [
    /*
     * Stripe will sign each webhook using a secret. You can find the used secret at the
     * webhook configuration settings: https://dashboard.stripe.com/account/webhooks.
     */
    'signing_secret' => env('STRIPE_WEBHOOK_SECRET'),

    /*
     * You can define the job that should be run when a certain webhook hits your application
     * here. The key is the name of the Stripe event type with the `.` replaced by a `_`.
     *
     * You can find a list of Stripe webhook types here:
     * https://stripe.com/docs/api#event_types.
     */
    'jobs' => [
        'charge_succeeded' => \App\Jobs\StripeWebhooks\ChargeSucceeded::class,
        'invoice_payment_succeeded' => \App\Jobs\StripeWebhooks\InvoicePaymentSucceeded::class,
        'invoice_payment_failed' => \App\Jobs\StripeWebhooks\InvoicePaymentFailed::class,
        'payment_method_attached' => \App\Jobs\StripeWebhooks\PaymentMethodAttached::class,
        'customer_subscription_updated' => \App\Jobs\StripeWebhooks\CustomerSubscriptionUpdated::class,
        'customer_subscription_deleted' => \App\Jobs\StripeWebhooks\CustomerSubscriptionDeleted::class,
        'customer_subscription_created' => \App\Jobs\StripeWebhooks\CustomerSubscriptionCreated::class,
        'charge_failed' => \App\Jobs\StripeWebhooks\ChargeFailed::class,
        // 'source_chargeable' => \App\Jobs\StripeWebhooks\HandleChargeableSource::class,
    ],

    /*
     * The classname of the model to be used. The class should equal or extend
     * Spatie\StripeWebhooks\ProcessStripeWebhookJob.
     */
    'model' => \Spatie\StripeWebhooks\ProcessStripeWebhookJob::class,

    /*
     * When disabled, the package will not verify if the signature is valid.
     * This can be handy in local environments.
     */
    'verify_signature' => env('STRIPE_SIGNATURE_VERIFY', false),
];
