<template>
	<div>
		<div v-for="item in content" :key="item.id" class="py-1">
			<div class="row p-3 table-pill">
				<div :class="has_variations ? 'col-lg-9 col-md-8 col-sm-7' : 'col-lg-10 col-md-9 col-sm-8'">
					{{ item.name }} - {{ item.content_type_name }}
				</div>
				<div class="col-1">
					<InertiaLink :href="route(`admin.${type}.edit`, [item.id])">edit</InertiaLink>
				</div>
				<div class="col-1">
					<InertiaLink :href="route(`admin.${type}.show`, [item.id])">view</InertiaLink>
				</div>
				<div class="col-1" v-if="has_variations">
					<InertiaLink :href="route(`admin.${type}.variations.index`, [item])">variations</InertiaLink>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
const props = defineProps({
	type: {
		type: String,
		required: true,
	},
	content: {
		type: Array,
		required: true,
	},
	has_variations: {
		type: Boolean,
		required: false,
		default: false,
	},
});
</script>

<script>
export default { name: 'ContentIndex' };
</script>
