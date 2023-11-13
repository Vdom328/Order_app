<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        EmailTemplate::updateOrInsert([
            'name' => 'reset_password_email',
            'subject' => 'Password Reset',
            'body' => '<p>Dear {{name}},</p>
                        <p>We received a request to reset your password. Please click the link below to reset it:</p>
                        <p><a href="{{reset_link}}" target="_blank">Reset Password</a></p>',
        ]);

        EmailTemplate::updateOrInsert([
            'name' => 'order_confirmation_email',
            'subject' => 'Order Confirmation - {{order_number}}',
            'body' => '<p>Dear {{name}},</p>
                        <p>Your order ({{order_number}}) has been confirmed. Thank you for choosing our service.</p>
                        <p>Details of your order:</p>
                        <ul>
                            @foreach($order_items as $item)
                                <li>{{ $item["name"] }} - {{ $item["quantity"] }} x ${{ $item["price"] }}</li>
                            @endforeach
                        </ul>
                        <p>Total Amount: ${{ total_amount }}</p>
                        <p>Expected Delivery Time: {{ delivery_time }}</p>
                        <p>Thank you for choosing our service!</p>',
        ]);

        // Add more templates as needed...

        $this->command->info('Email templates seeded successfully!');
    }
}
