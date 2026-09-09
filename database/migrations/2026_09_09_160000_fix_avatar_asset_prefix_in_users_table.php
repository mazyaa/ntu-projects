<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $users = DB::table('users')
            ->where('avatar', 'LIKE', 'http%storage/%')
            ->get();

        foreach ($users as $user) {
            $path = preg_replace('#^.*/storage/#', '', $user->avatar);
            DB::table('users')->where('id', $user->id)->update(['avatar' => $path]);
        }
    }

    public function down(): void
    {
        $users = DB::table('users')
            ->where('avatar', '!=', null)
            ->where('avatar', '!=', '')
            ->get();

        foreach ($users as $user) {
            if (! str_starts_with($user->avatar, 'http')) {
                DB::table('users')->where('id', $user->id)->update([
                    'avatar' => asset('storage/'.$user->avatar),
                ]);
            }
        }
    }
};
