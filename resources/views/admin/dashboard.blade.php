<a title="LogOut" href="{{ route('admin.auth.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="icon-power"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST">
                                        @csrf
                                    </form>