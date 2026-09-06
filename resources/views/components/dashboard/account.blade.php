@props(['user' => Auth::user()])

<div x-show="tab === 'account'" x-data="{ editMode: false, modalConfirm: false }">
    <div class="flex flex-col my-3 mb-4">
        <span class="text-2xl font-semibold">My Account</span>
        <span class="text-gray-500">Manage Your Profile and Account Settings</span>
    </div>

    <div class="flex flex-col lg:flex-row gap-4">
        <div class="w-full lg:w-2/3 flex flex-col gap-4">
            <div class="rounded-lg border border-gray-200 shadow-sm p-5">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="uppercase w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-medium">
                            {{ substr($user->name ?? Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <h1 class="font-bold text-xl">{{ $user->name ?? Auth::user()->name }}</h1>
                            <span class="text-xs uppercase font-semibold text-gray-500"></span>
                        </div>
                    </div>

                    <button @click="editMode = !editMode" type="button"
                            class="py-1.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                        <x-lucide-pencil class="w-4 h-4" />
                        <span x-text="editMode ? 'Cancel' : 'Edit Profile'"></span>
                    </button>
                </div>

                <form action="{{ route('dashboard.updateProfile') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="name" class="block text-sm font-medium text-foreground mb-1.5">Full Name</label>
                        <div class="relative">
                            <input type="text" id="name" name="name" value="{{ $user->name ?? Auth::user()->name }}" :disabled="!editMode"
                                   class="peer py-2.5 sm:py-3 px-4 ps-11 block w-full bg-surface border-transparent rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:bg-layer focus:border-primary-focus focus:ring-primary-focus disabled:opacity-50 disabled:pointer-events-none"
                                   placeholder="Enter name">
                            <div class="absolute inset-y-0 inset-s-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                <x-lucide-user class="shrink-0 size-4 text-muted-foreground-1" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-foreground mb-1.5">Email Address</label>
                        <div class="relative">
                            <input type="email" id="email" name="email" value="{{ $user->email ?? Auth::user()->email }}" :disabled="!editMode"
                                   class="peer py-2.5 sm:py-3 px-4 ps-11 block w-full bg-surface border-transparent rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:bg-layer focus:border-primary-focus focus:ring-primary-focus disabled:opacity-50 disabled:pointer-events-none"
                                   placeholder="Enter email">
                            <div class="absolute inset-y-0 inset-s-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                <x-lucide-mail class="shrink-0 size-4 text-muted-foreground-1" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-foreground mb-1.5">Phone Number</label>
                        <div class="relative">
                            <input type="text" id="no_hp" name="no_hp" value="{{ $user->no_hp ?? Auth::user()->no_hp }}" :disabled="!editMode"
                                   class="peer py-2.5 sm:py-3 px-4 ps-11 block w-full bg-surface border-transparent rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:bg-layer focus:border-primary-focus focus:ring-primary-focus disabled:opacity-50 disabled:pointer-events-none"
                                   placeholder="Enter phone number">
                            <div class="absolute inset-y-0 inset-s-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                <x-lucide-phone class="shrink-0 size-4 text-muted-foreground-1" />
                            </div>
                        </div>
                    </div>

                    <div x-show="editMode" class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="editMode = false"
                                class="py-2 px-4 text-sm font-medium rounded-lg border border-gray-200 hover:bg-gray-50 focus:outline-hidden">
                            Discard
                        </button>
                        <button type="submit"
                                class="py-2 px-4 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <div class="rounded-lg border border-gray-200 shadow-sm p-5">
                <div class="flex items-center gap-2 pb-4 mb-4 border-b border-gray-100">
                    <x-lucide-lock class="w-5 h-5" />
                    <h1 class="font-semibold text-lg">Change Password</h1>
                </div>

                <form action="{{ route('dashboard.updatePassword') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="tab" value="account">

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="text-sm font-medium text-gray-600">New Password</label>
                            <input type="password" name="new_password" placeholder="••••••••"
                                   class="mt-1 w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-hidden focus:border-primary">
                            <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <label class="text-sm font-medium text-gray-600">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" placeholder="••••••••"
                                   class="mt-1 w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-hidden focus:border-primary"
                                   autocomplete="new-password">
                            <x-input-error :messages="$errors->get('new_password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit"
                                class="py-2 px-4 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="w-full lg:w-1/3 flex flex-col gap-4">
            <div class="rounded-lg border border-gray-200 shadow-sm p-5">
                <h1 class="font-semibold text-lg pb-4 mb-4 border-b border-gray-100">Account Information</h1>

                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                        <div class="text-primary-500 bg-primary/15 p-2 rounded-full">
                            <x-lucide-shield class="w-5 h-5" />
                        </div>
                        <div>
                            <h5 class="text-xs font-semibold text-gray-500">Role</h5>
                            <h1 class="font-semibold capitalize">{{ $user->role ?? Auth::user()->role }}</h1>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="text-primary-500 bg-primary/15 p-2 rounded-full">
                            <x-lucide-calendar class="w-5 h-5" />
                        </div>
                        <div>
                            <h5 class="text-xs font-semibold text-gray-500">Member Since</h5>
                            <h1 class="font-semibold">{{ ($user->created_at ?? Auth::user()->created_at)->format('Y-m-d') }}</h1>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="text-primary-500 bg-primary/15 p-2 rounded-full">
                            <x-lucide-hash class="w-5 h-5" />
                        </div>
                        <div>
                            <h5 class="text-xs font-semibold text-gray-500">User ID</h5>
                            <h1 class="font-semibold">#{{ $user->user_id ?? Auth::user()->user_id }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-red-200 shadow-sm p-5">
                <h1 class="font-semibold text-lg text-red-500 pb-4 mb-4 border-b border-red-100">Danger Zone</h1>
                <p class="text-sm text-gray-500 mb-4">
                    Once you delete your account, there is no going back. Please be certain.
                </p>
                <button type="button" @click="modalConfirm = true"
                        class="w-full py-2.5 px-4 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:bg-red-50 focus:outline-hidden">
                    Delete Account
                </button>
            </div>
        </div>
    </div>

    <div x-show="modalConfirm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="modalConfirm = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-cloak>
        <div @click.away="modalConfirm = false" class="relative max-w-md w-full bg-white rounded-2xl overflow-hidden shadow-2xl p-6 flex flex-col">
            <button @click="modalConfirm = false" type="button" class="absolute top-4 right-4 z-10 p-2 text-gray-400 hover:text-gray-600 transition-colors">
                <x-lucide-x class="w-5 h-5" />
            </button>

            <div class="flex items-center gap-3 text-red-500 mb-3">
                <x-lucide-alert-triangle class="w-6 h-6 shrink-0" />
                <h3 class="text-lg font-bold text-gray-900">Delete Account</h3>
            </div>

            <p class="text-sm text-gray-600 mb-6">
                Are you sure you want to delete your account? All of your resources and data will be permanently removed. This action cannot be undone.
            </p>

            <form action="{{ route('dashboard.destroy') }}" method="POST" class="flex justify-end gap-3">
                @csrf
                @method('DELETE')
                <button type="button" @click="modalConfirm = false"
                        class="py-2 px-4 text-sm font-medium rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 focus:outline-hidden">
                    Cancel
                </button>
                <button type="submit"
                        class="py-2 px-4 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-700 focus:outline-hidden">
                    Confirm Delete
                </button>
            </form>
        </div>
    </div>
</div>
