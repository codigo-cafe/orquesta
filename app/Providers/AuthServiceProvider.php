<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Classification;
use App\Models\Instrument;
use App\Models\Member;
use App\Models\Person;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\Type;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\ClassificationPolicy;
use App\Policies\InstrumentPolicy;
use App\Policies\MemberPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\PersonPolicy;
use App\Policies\PromotionPolicy;
use App\Policies\RolePolicy;
use App\Policies\ServicePolicy;
use App\Policies\TypePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Category::class => CategoryPolicy::class,
        //Event::class => EventPolicy::class,
        Classification::class => ClassificationPolicy::class,
        Instrument::class => InstrumentPolicy::class,
        Service::class => ServicePolicy::class,
        Promotion::class => PromotionPolicy::class,
        Type::class => TypePolicy::class,
        Person::class => PersonPolicy::class,
        Member::class => MemberPolicy::class,
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
