<template>
	<div v-if="active" class="mb-5">
		<Header text="Active season"/>

		<SeasonCard :season="active" class="col-lg-4 col-md-6 col-12"/>
	</div>

	<div v-if="pending.length">
		<Header text="Upcoming seasons"/>

		<div class="container">
			<div class="row">
				<SeasonCard :season="season" v-for="season in pending" :key="season.id"
							class="col-lg-4 col-md-6 col-12"/>
			</div>
		</div>
	</div>

	<div v-if="completed.length">
		<Header text="Past seasons"/>

		<div class="row">
			<SeasonCard :season="season" v-for="season in completed" :key="season.id"
						class="col-lg-4 col-md-6 col-12"></SeasonCard>
		</div>
	</div>
</template>

<script setup>
import SeasonCard from '@/Shared/SeasonCard';
import Header from '@/Shared/Header';

const props = defineProps({
	active: {
		type: Object,
		required: false,
	},
	pending: {
		type: Array,
		required: true,
	},
	completed: {
		type: Array,
		required: true,
	},
});
</script>
