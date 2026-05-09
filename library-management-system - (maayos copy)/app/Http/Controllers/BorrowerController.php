<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BorrowerController extends Controller
{
    public function index(Request $request)
{
    $query = $request->query('q');

    $borrowers = Borrower::with('user')
        ->when($query, function ($borrowers, $query) {
            $borrowers->whereHas('user', function ($user) use ($query) {
                $user->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
            })
            ->orWhere('membership_id', 'like', "%{$query}%");
        })
        ->paginate(15)
        ->withQueryString();

    // ✅ TOTAL BORROWERS COUNT (IMPORTANT)
    $totalBorrowers = Borrower::count();

    return view('admin.borrowers.index', compact('borrowers', 'totalBorrowers'));
}
    public function create()
    {
        $users = User::where('role', 'user')
            ->doesntHave('borrower')
            ->get();

        return view('admin.borrowers.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:borrowers,user_id',
            'membership_date' => 'required|date',
        ]);

        $borrower = Borrower::create([
            'user_id' => $validated['user_id'],
            'membership_date' => $validated['membership_date'],

            // ✅ system-generated membership ID
                'membership_id' => 'MEM-' . strtoupper(Str::random(8)),

            'status' => 'active',
        ]);

        $user = User::find($validated['user_id']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Registered borrower: {$user->name}",
            'model_type' => 'Borrower',
            'model_id' => $borrower->id,
        ]);

        return redirect('/admin/borrowers')
            ->with('success', 'Borrower registered successfully.');
    }

    public function edit(Borrower $borrower)
    {
        return view('admin.borrowers.edit', compact('borrower'));
    }

    public function update(Request $request, Borrower $borrower)
    {
        $validated = $request->validate([
            'membership_date' => 'required|date',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $borrower->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated borrower: {$borrower->user->name}",
            'model_type' => 'Borrower',
            'model_id' => $borrower->id,
        ]);

        return redirect('/admin/borrowers')
            ->with('success', 'Borrower updated successfully.');
    }

    public function destroy(Borrower $borrower)
    {
        $name = $borrower->user->name;

        // ❗ Prevent deleting if active borrowed books exist
        if ($borrower->transactions()->where('status', 'borrowed')->exists()) {
            return back()->with('error', 'Cannot delete borrower with active loans.');
        }

        $borrower->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted borrower: {$name}",
            'model_type' => 'Borrower',
            'model_id' => $borrower->id,
        ]);

        return redirect('/admin/borrowers')
            ->with('success', 'Borrower deleted successfully.');
    }
}