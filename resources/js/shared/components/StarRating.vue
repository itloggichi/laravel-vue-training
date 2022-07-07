<template>
  <div class="d-flex">
    <i
      class="fas fa-star"
      v-for="star in fullStars"
      :key="'full' + star"
      @click="$emit('input', star)"
    ></i>
    <i class="fas fa-star-half-alt" v-if="halfStar"></i>
    <i
      class="far fa-star"
      v-for="star in emptyStars"
      :key="'empty' + star"
      @click="$emit('input', fullStars + star)"
    ></i>
  </div>
</template>

<script>
export default {
  props: {
    value: Number
  },
  computed: {
    halfStar() {
      const fraction = Math.round(
        (this.value - Math.floor(this.value)) * 100
      );
      // if decimal place greater .0 but less than .5, round up to .5

      return fraction > 0 && fraction < 50;
    },
    fullStars() {
      // if decimal place greater than .5. round up
      return Math.round(this.value);
    },
    emptyStars() {
      return 5 - Math.ceil(this.value);
    }
  }
};
</script>