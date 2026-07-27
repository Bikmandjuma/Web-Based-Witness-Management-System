@extends('Users.admin.cover')
@section('content')

  <div class="flex-col min-h-screen">
    <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
      <h1 class="text-2xl font-semibold">Assign payment</h1>
        <a
                href="{{ route('owner.display_paid_users') }}"
                class="px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark"
              >
                View paid users
        </a>
    </div>

    <div class="container mx-auto">
        
      <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
          <!-- <div>
            <h2 class="text-2xl font-semibold leading-tight"> to a user</h2>
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
                 
              </tr>
              

                @empty
                <tr>
                    <td colspan="4" class="p-3 text-center text-gray-700">User not found</td>
                </tr>
                @endforelse

            </tbody>

        </table>
        
      </div>

        <div class="container mx-auto p-4 flex justify-center">
            <div class="w-full lg:w-1/3 md:w-1/2 bg-white">
              <div class="w-full max-w-sm px-4 py-6 space-y-6 bg-white rounded-md dark:bg-darker">
                <h3 class="text-center">Assign payment</h3>

                <!-- Form -->
                <form action="{{ route('owner.submit_payment_ToUser', $user_id) }}" method="POST">
                  @csrf <!-- CSRF token for Laravel -->

                  <!-- Amount Select -->
                  <select
                    class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker mb-2"
                    name="amount"
                    required
                  >
                    <option disabled selected>Select amount</option>
                    <option value="5000">5000</option>
                    <option value="12000">12000</option>
                    <option value="20000">20000</option>
                  </select>

                  <!-- Duration Select -->
                  <select
                    class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker mb-2"
                    name="duration"
                    required
                  >
                    <option disabled selected>Select duration</option>
                    <option value="3">3 months</option>
                    <option value="8">8 months</option>
                    <option value="15">1 year + 3 months</option>
                  </select>

                  <!-- Submit Button -->
                  <button
                    type="submit"
                    class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker"
                  >
                    Approve payment
                  </button>
                </form>
              </div>
            </div>
          </div>


      </div>
    </div>
  </div>

        
    </div>

           
             
  </div>

@endsection