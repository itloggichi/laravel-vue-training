<template>
  <div>
    <div v-if="loading">
        Loading . . .
    </div>
    <div v-else>
        <div v-if="alreadyReviewed">
        <h1>A review was already left on this booking.</h1>
        </div>
        <div v-else>
            <div class="form-group">
                <div class="d-flex align-items-center justify-content-center">
                    <label class="text-muted">Select a star rating!</label>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <star-rating 
                    class="fa-3x"
                    v-model="review.rating"
                    >
                    </star-rating>
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="text-muted">Describe your experience!</label>
                <textarea 
                name="content" 
                cols="30" 
                rows="10" 
                class="form-control"
                v-model="review.content"
                ></textarea>
            </div>
            <button class="btn btn-lg btn-primary btn-block">Submit Review</button> 
        </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      review: {
        rating: 0,
        content: null
      },
      existingReview: null,
      loading: false
    };
  },
  created() {
    //1: check if review already exists, check in review table
    this.loading = true;
    axios
    .get(`/api/reviews/${this.$route.params.id}`)
    .then(response => (this.existingReview = response.data.data))
    .catch(error => 
    {
        
    })
    .then(() => 
    {
        this.loading = false;
    }
    );
    //2: fetch a booking by a review key
    //3: store the review
  },
  computed: {
    alreadyReviewed() {
        return this.existingReview != null;
    }
  }
};
</script> 