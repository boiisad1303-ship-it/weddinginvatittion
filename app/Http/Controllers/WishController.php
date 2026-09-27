<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WishController extends Controller
{
    public function storeWish(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'guest_name' => ['required', 'string', 'max:100'],
            'attendance_status' => ['required', 'in:Yes,No'],
            'guest_count' => ['nullable', 'integer', 'min:1', 'max:10'],
            'message' => ['nullable', 'string', 'max:2000'],
            'receipt_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('receipt_image')) {
            $validated['receipt_image'] = $request->file('receipt_image')->store('receipts', 'local');
        }

        Wish::query()->create($validated);

        return redirect()->to(route('wedding.show') . '#rsvp')->with('status', 'Your response has been received. Thank you!');
    }
}
