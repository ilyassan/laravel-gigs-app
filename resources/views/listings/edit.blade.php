<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Gig
            </h2>
            <p class="mb-4">Edit: {{$listing->title}}</p>
        </header>

        <form action="/listings/{{$listing->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="company" class="inline-block text-lg mb-2">Company Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" value="{{$listing->company}}"
                    name="company" />

                @error('company')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

            </div>

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Job Title</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                    placeholder="Example: Senior Laravel Developer" value="{{$listing->title}}" />

                @error('title')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

            </div>

            <div class="mb-6">
                <label for="location" class="inline-block text-lg mb-2">Job Location</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
                    placeholder="Example: Remote, Marrackech MA, etc" value="{{$listing->location}}" />

                @error('location')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Contact Email</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" value="{{$listing->email}}"
                    name="email" />

                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

            </div>

            <div class="mb-6">
                <label for="website" class="inline-block text-lg mb-2">
                    Website/Application URL
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" value="{{$listing->website}}"
                    name="website" />

                @error('website')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tags (Comma Separated)
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                    placeholder="Example: Laravel, Backend, Frontend, etc" value="{{$listing->tags}}" />

                @error('tags')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

            </div>

            {{-- Some alpinejs --}}
            <div
                x-data="{ isNewImage: false, imagePath: '{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png') }}' }">
                <div class="mb-6">
                    <label for="logo" class="inline-block text-lg mb-2">Company Logo</label>
                    <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo"
                        x-on:change="isNewImage = true; imagePath = URL.createObjectURL($event.target.files[0])" />
                </div>

                <label x-show="!isNewImage">Current Logo</label>
                <img x-show="!isNewImage" class="w-48 mr-6 mb-6" x-bind:src="imagePath" alt="logo" />

                <label x-show="isNewImage">New Logo</label>
                <img x-show="isNewImage" class="w-48 mr-6 mb-6" x-bind:src="imagePath" alt="uploaded logo" />
            </div>

            @error('logo')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Job Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                    placeholder="Include tasks, requirements, salary, etc">{{$listing->description}}</textarea>

                @error('description')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror

            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Update Gig
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>