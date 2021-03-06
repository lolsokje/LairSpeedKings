<template>
	<BackToOverviewButton :link="route('admin.seasons.rounds.index', [season])"/>

	<Header :text="'Add round to ' + season.name"/>

	<div class="card">
		<div class="card-body">
			<form @submit.prevent="form.post(route('admin.seasons.rounds.store', [season]))">
				<div v-if="form.errors">
					<p class="text-danger" v-for="error in form.errors">{{ error }}</p>
				</div>

				<div class="row mb-3">
					<div class="col-10">
						<label for="name" class="form-label">Name</label>
						<input type="text" class="form-control" v-model="form.name" id="name" required>
					</div>
					<div class="col-2">
						<label for="tla" class="form-label">TLA</label>
						<input type="text" class="form-control" v-model="form.tla" id="tla" maxlength="3" required>
					</div>
					<small class="text-end">
						The TLA will be shown on the season standings page, so make sure it's unique within the season
					</small>
				</div>

				<div class="row mb-3">
					<div class="col-lg-4 col-md-6 col-12">
						<label for="car" class="form-label">Car</label>
						<select id="car" class="form-select" v-model="form.car_id" required>
							<option v-for="car in cars" :key="car.id" :value="car.id">{{ car.name }}</option>
						</select>
					</div>

					<div class="col-lg-4 col-md-6 col-12">
						<label for="track" class="form-label">Track</label>
						<select id="track" class="form-select" v-model="selectedTrackId">
							<option v-for="track in tracks" :key="track.id" :value="track.id">{{ track.name }}</option>
						</select>
					</div>

					<div class="col-lg-4 col-md-6 col-12">
						<label for="track_variation" class="form-label">Track variation</label>
						<select id="track_variation" class="form-select" v-model="form.track_variation_id"
								:disabled="selectedTrack === ''" required>
							<option v-for="variation in variations" :key="variation.id" :value="variation.id">
								{{ variation.name }}
							</option>
						</select>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-6">
						<label for="start_date" class="form-label">Start date</label>
						<input type="date" class="form-control" id="start_date" v-model="form.starts_at" required>
					</div>

					<div class="col-6">
						<label for="end_date" class="form-label">End date</label>
						<input type="date" class="form-control" id="end_date" v-model="form.ends_at" required>
					</div>
				</div>

				<div class="mb-3">
					<label for="notes" class="form-label">Round notes</label>
					<textarea v-model="form.notes" id="notes" class="form-control" rows="6"></textarea>
				</div>

				<button type="submit" class="btn btn-primary" v-if="formValid">Save</button>
			</form>
		</div>
	</div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { computed, ref, watch } from 'vue';
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';

const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
	tracks: {
		type: Array,
		required: true,
	},
	cars: {
		type: Array,
		required: true,
	},
});

const selectedTrack = ref(props.tracks[0]);
const selectedTrackId = ref(selectedTrack.value.id);
const variations = ref(selectedTrack.value.variations);

const form = useForm({
	name: '',
	tla: '',
	car_id: props.cars[0].id,
	track_variation_id: variations.value[0].id,
	starts_at: '',
	ends_at: '',
	notes: '',
});

const formValid = computed(() => {
	return form.name.length >= 3
		&& form.tla.length === 3
		&& form.car_id !== ''
		&& form.track_variation_id !== ''
		&& form.starts_at !== ''
		&& form.ends_at !== '';
});

watch(selectedTrackId, (trackId) => {
	if (!trackId) {
		variations.value = [];
		return;
	}

	const selectedTrack = props.tracks.find((t) => t.id === trackId);
	variations.value = selectedTrack.variations;
	form.track_variation_id = variations.value[0].id;
});
</script>
