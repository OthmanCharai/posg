

<template>
  <div
    class="modal fade"
    id="bs-example-modal-lg"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myLargeModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">
            <slot name="title"></slot>
          </h4>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
          </button>
        </div>
        <div class="modal-body">
          <slot name="body"></slot>
        </div>
      </div>
    </div>
  </div>
</template>

// action button to trigger the modal
<button
  type="button"
  class="btn btn-primary mt-1"
  data-bs-toggle="modal"
  data-bs-target="#bs-example-modal-lg"
>
  Show modal
</button>
