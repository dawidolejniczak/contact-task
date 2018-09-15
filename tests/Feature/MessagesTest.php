<?php

namespace Tests\Feature;

use Tests\TestCase;

class MessagesTest extends TestCase
{
    public function testStoreValid(): void
    {
        $response = $this->post(route('messages.store'), [
            'name' => 'test name',
            'email' => 'test@example.com',
            'subject' => 'test subject',
            'message' => 'test message',
        ]);

        $response->assertRedirect(route('messages.index'));
    }


    public function testStoreMessageWithWrongEmail(): void
    {
        $response = $this->post(route('messages.store'), [
            'name' => 'test name',
            'email' => 'wrong email',
            'subject' => 'test subject',
            'message' => 'test message',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'The email must be a valid email address.'
        ]);
    }

    public function testStoreMessageWithoutFields(): void
    {
        $response = $this->post(route('messages.store'));

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
            'email' => 'The email field is required.',
            'subject' => 'The subject field is required.',
            'message' => 'The message field is required.',
        ]);
    }
}
