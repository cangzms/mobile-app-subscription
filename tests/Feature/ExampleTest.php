<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Transaction;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        /*$response = $this->get('/');

        $response->assertStatus(200);*/
        $records = Transaction::where('expire_date', '<', now())
            ->where('cancelled', false)
            ->where('processed', false)
            ->limit(100)
            ->get();

        foreach ($records as $record) {
            $os = $record->os;

            // OS değerine göre doğrulama
            if ($os === 'ios') {
                $isValid = true;
            } elseif ($os === 'android') {
                $isValid = true;
            } else {
                $isValid = false;
            }

            if ($isValid == true) {
                $record->update(['processed' => true]);
            } elseif ($isValid == false) {
                $record->update(['retry_count' => DB::raw('retry_count + 1')]);
            }
        }
    }
}
