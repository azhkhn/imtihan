<?php

namespace Tests\Feature\Admin\Payment;

use App\Models\PaymentCoupon;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PaymentCouponControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/payment/coupons/';

    public function test_payment_coupon_list()
    {
        PaymentCoupon::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-coupon.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_payment_coupon_create()
    {
        $paymentCoupon = PaymentCoupon::factory()->make();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-coupon.create']);

        $response = $this->postJson($this->apiUrl, $paymentCoupon->toArray());
        $response->assertStatus(201);
    }

    public function test_payment_coupon_show()
    {
        $paymentCoupon = PaymentCoupon::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-coupon.show']);

        $response = $this->get($this->apiUrl.$paymentCoupon->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $paymentCoupon->id]);
    }

    public function test_payment_coupon_update()
    {
        $paymentCoupon = PaymentCoupon::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-coupon.update']);

        $response = $this->putJson($this->apiUrl.$paymentCoupon->id, [
            'name' => 'test',
            'code' => 'test',
            'type' => 'test',
            'value' => 1,
            'start_date' => '2021-01-01',
            'end_date' => '2021-01-01',
            'status' => 1,
        ]);
        $response->assertStatus(200);
    }

    public function test_payment_coupon_delete()
    {
        $paymentCoupon = PaymentCoupon::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-coupon.delete']);

        $response = $this->delete($this->apiUrl.$paymentCoupon->id);
        $response->assertStatus(200);
    }
}
