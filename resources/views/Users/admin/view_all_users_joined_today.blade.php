@extends('Users.admin.cover')
@section('content')

  <div class="flex-col min-h-screen">
    <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
      <h1 class="text-2xl font-semibold">All users <span class="badge bg-primary rounded-lg p-2">{{ $count_users }}</span> </h1>
        <a
                href="{{ route('owner.display_paid_users') }}"
                class="px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark"
              >
                View paid users
        </a>
    </div>

    <div class="container mx-auto p-4">
        <!-- Search Form -->
        <div class="mb-6" style="position:relative;align-items: center;justify-content: center;justify-items: center;text-align: center;">
            <form method="GET" action="{{ url('/owner/search_users_payment') }}" class="flex justify-between items-center">
                <div class="flex space-x-4">
                    <input
                        type="text"
                        name="search"
                        required
                        value="{{ request('search') }}"
                        placeholder="Searching...."
                        class="p-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-100 w-80"
                    />
                    <button type="submit" style="position:relative;margin-left: -55px;" class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none">
                        Search
                    </button>
                </div>
            </form>
        </div>

      <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
         <!--  <div>
            <h2 class="text-2xl font-semibold leading-tight">Searched_user</h2>
          </div> -->
          <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div
              class="inline-block min-w-full shadow-md rounded-lg overflow-hidden"
            >

        <!-- Users Table -->
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md leading-normal">
            <thead>
                <tr>
                  <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                  >
                    User_names / Code
                  </th>
                  <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                  >
                    Email/Phone
                  </th>
                  <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                  >
                     DoB/ Gender
                  </th>
                  <!-- <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                  >
                    Action
                  </th> -->
                  <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"
                  ></th>
                </tr>
              </thead>
            <tbody>
                @forelse($users as $user)
                
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                      <div class="flex">
                        <div class="flex-shrink-0 w-10 h-10">
                          <img
                            class="w-full h-full rounded-full"
                            src="{{ URL::to('/') }}/users/images/user.jpg"
                            alt=""
                          />
                        </div>
                        <div class="ml-3">
                          <p class="text-gray-900 whitespace-no-wrap">
                            {{ $user->firstname }} {{ $user->lastname }}
                          </p>
                          <p class="text-gray-600 whitespace-no-wrap">{{ $user->user_code }}</p>
                        </div>
                      </div>
                    </td>
                    
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                      <p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p>
                      <p class="text-gray-600 whitespace-no-wrap">{{ $user->phone }}</p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                      <p class="text-gray-900 whitespace-no-wrap">{{ $user->birthdate }}</p>
                      <p class="text-gray-600 whitespace-no-wrap">{{ $user->gender }}</p>
                    </td>

                    <!-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                      <a
                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                        href="{{ route('owner.assign_payment_ToUser',Crypt::encrypt($user->id)) }}"
                      >
                        <span
                          aria-hidden
                          class="absolute inset-0 bg-green-200 opacity-50 rounded-full"
                        ></span>
                        <span class="relative"></span>
                      </a>
                    </td> -->
                    <!-- <td
                      class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right"
                    >
                      <button
                        type="button"
                        class="inline-block text-gray-500 hover:text-gray-700"
                      >
                        <svg
                          class="inline-block h-6 w-6 fill-current"
                          viewBox="0 0 24 24"
                        >
                          <path
                            d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z"
                          />
                        </svg>
                      </button>
                    </td> -->
              </tr>
              

                @empty
                <tr>
                    <td colspan="4" class="p-3 text-center text-gray-700">No results found</td>
                </tr>
                @endforelse

            </tbody>

        </table>
      </div></div></div></div>


      <div class="mt-4 text-center items-center justify-center" id="pag_id">
          <nav aria-label="Page navigation">
              <ul class="inline-flex items-center space-x-2">
                  @if ($users->onFirstPage())
                      <li>
                          <span class="px-3 py-1 text-gray-500 bg-gray-100 border rounded-md cursor-not-allowed">
                              Previous
                          </span>
                      </li>
                  @else
                      <li>
                          <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1 text-blue-500 bg-gray-100 border rounded-md hover:bg-blue-100">
                              Previous
                          </a>
                      </li>
                  @endif

                  @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                      <li>
                          @if ($page == $users->currentPage())
                              <span class="px-3 py-1 text-white bg-blue-500 border rounded-md">
                                  {{ $page }}
                              </span>
                          @else
                              <a href="{{ $url }}" class="px-3 py-1 text-blue-500 bg-gray-100 border rounded-md hover:bg-blue-100">
                                  {{ $page }}
                              </a>
                          @endif
                      </li>
                  @endforeach

                  @if ($users->hasMorePages())
                      <li>
                          <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1 text-blue-500 bg-gray-100 border rounded-md hover:bg-blue-100">
                              Next
                          </a>
                      </li>
                  @else
                      <li>
                          <span class="px-3 py-1 text-gray-500 bg-gray-100 border rounded-md cursor-not-allowed">
                              Next
                          </span>
                      </li>
                  @endif
              </ul>
          </nav>
        </div>

        
    </div>
       
  </div>

@endsection