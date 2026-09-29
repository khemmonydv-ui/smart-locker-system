@forelse ($locations as $location)
    <x-location-card
        :location="$location"
        :name="$location->name"
        :address="$location->address"
        :distance="$location->distance_km"
        :available="$location->available_slots"
        :is-open="$location->is_open"
    />
@empty
    <p class="text-center text-sm text-gray-400 mt-10">No locations match your search.</p>
@endforelse
