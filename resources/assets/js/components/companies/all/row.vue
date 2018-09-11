<template>
    <tr>
        <td>
            <div class="inner-border">
                <div class="company__main-info">
                    <div class="company__logo">
                        <img v-if="company.image" :src="company.image" width="100%" />
                        <div v-else class="company__default-logo"></div>
                    </div>
                    <div class="company__name">
                        {{ company.name }}
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="inner-border">
                {{ company.city }}, {{ company.country }}
            </div>
        </td>
        <td>
            <div class="inner-border">
                {{ company.description }}
            </div>
        </td>
        <td width="300px">
            <div class="company__labels">
                <div class="company__label">
                    {{ company.vertical.name }}
                </div>
                <div class="company__label">
                    {{ company.progress_type.name }}
                </div>
            </div>
        </td>
        <td>
            <div class="company__actions inner-border">
                <a class="btn icon" :href="'/companies/' + company.slug">
                    <font-awesome-icon :icon="['far', 'user-circle']"></font-awesome-icon>
                </a>
                <a class="btn icon" :href="company.url" target="_blank">
                    <font-awesome-icon :icon="['fas', 'link']"></font-awesome-icon>
                </a>
                <button v-if="company.is_contactable" class="btn icon" @click="contact">
                    <font-awesome-icon :icon="['far', 'envelope']"></font-awesome-icon>
                </button>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: 'company-row',

        props: {
            company: {
                type: Object,
                required: true
            }
        },

        methods: {
            contact() {
                this.$store.dispatch('companies/contact', this.company.slug);
            }
        }
    }
</script>