<?php

namespace App\Livewire\Auth;

use Exception;
use App\Enums\RoleEnum;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;
use App\Exceptions\HandledException;
use App\Services\User\UserInterface;
use App\Traits\HandleInteraction;
use TallStackUi\Traits\Interactions;

#[Layout('components.layouts.auth')]
#[Title('Login')]
class LoginIndex extends Component
{
    use HandleInteraction;
    public $email;
    public $password;
    public $remember = false;

    protected $userService;
    public function boot(
        UserInterface $userService
    ) {
        $this->userService = $userService;
    }

    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }
    public function render()
    {
        return view('livewire.auth.login-index');
    }
    public function login()
    {
        $this->validate();
        try {
            $user = $this->userService->login(identifier: $this->email, credential: $this->password, remember: $this->remember);
            if ($user?->hasRole(RoleEnum::ADMIN->value)) {
                $this->redirect(route('admin.dashboard'));
            }
        } catch (Exception | HandledException $e) {
            Log::error($e->getMessage());
            return $this->toastError($e);
        }
    }
}
