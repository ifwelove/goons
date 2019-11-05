<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Role;
use App\Models\SysAdmin as Account;
use Illuminate\Support\Collection;

class AccountService
{
    public function __construct()
    {
    }

    public function clients(Account $account) : Collection
    {
        $clients = collect([]);

        switch ($account) {
            case $account->hasRole([Role::ADMIN]):
                $clients = Client::with(['senders'])->get();
                break;

            case $account->hasRole([Role::HEADQUARTER]):
                if ($account->client->is_fdsd) {
                    $clients = $account->client()->with(['senders'])->get();
                } else {
                    $clients = Client::where('source', $account->client->source)->get();
                }
                break;

            case $account->hasRole([Role::CLIENT]):
                $clients = $clients->push($account->client);
                break;
        }

        return $clients;
    }
}
