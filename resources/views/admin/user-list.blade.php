<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">
                    <div class="row justify-content-center">

                        <!-- Main Content -->
                        <main class="col-md-10 col-lg-8 px-4">
                            <div class="bg-white rounded shadow-sm p-4 mb-4 text-center">
                                <h2>User List</h2>
                                <p>Here you can see all the registered users and admins of the website.</p>
                            </div>



                            <!-- Game Schedule Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>

                                        <th scope="col"></th>
                                        <th scope="col">Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1?>
                                    @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}</td>
                                        <td></td>
                                        <td>{{$user->created_at->diffForHumans( )}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>


                    </div>
                </div>
            </section>
        </main>
        <footer class="text-light py-4" style="background-color:#001C43">
            <div class="container text-center mt-3">
                <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
            </div>
        </footer>
    </div>
</x-app-layout>