<div class="flex items-center justify-between flex-shrink-0 px-3">
    <!-- Profile Link -->
    <a href="{{ route('profile-show') }}" class="profile-link">
        <div class="profile-picture">
            <img src="{{ Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('images/default-profile.jpeg') }}"
                alt="{{ Auth::user()->name }} Profile Picture" class="profile-image" />
        </div>
        <div class="user-details">
            <h1 class="user-name">{{ Auth::user()->surname }}, {{ Auth::user()->first_name }}</h1>
        </div>
    </a>

    <!-- Toggle Button -->

</div>

<style scoped>

    /* Define styles for the profile link */
.profile-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    text-align: center;
    text-decoration: none;
    color: #333; /* Set your desired text color */
}

/* Define styles for the profile picture container */
.profile-picture {
    width: 120px; /* Adjust the width as needed */
    height: 120px; /* Adjust the height as needed */
    border-radius: 50%;
    overflow: hidden;
    background-color: #ddd; /* Fallback background color */
}

/* Define styles for the profile image */
.profile-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: inherit; /* Match the parent's border-radius */
}

/* Define styles for the user's name */
.user-name {
    font-size: 1.5rem; /* Adjust the font size as needed */
    font-weight: 600; /* Adjust the font weight as needed */
    margin-top: 0.5rem; /* Adjust the margin-top as needed */
}


</style>
