<template>
    <div class="fixed inset-0 flex items-center justify-center z-50">
      <div class="absolute inset-0 bg-black opacity-50"></div>
      <div class="bg-white rounded-lg shadow-lg p-6 z-10 max-w-lg w-full mx-4 sm:mx-6 md:mx-8 lg:mx-10">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold text-[#543434]">{{ title }}</h3>
          <button @click="$emit('close')" class="text-[#c58a61] hover:text-[#a7674d]">&times;</button>
        </div>
        <div class="mb-4 text-[#543434] modal-content">
          <slot></slot>
        </div>
        <div class="flex justify-end">
          <button @click="$emit('close')" class="bg-[#281c11] text-white px-4 py-2 rounded hover:bg-[#c59461]">Close</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      title: {
        type: String,
        required: true,
      },
    },
  };
  </script>
  
  <style scoped>
  /* Ensure the modal is responsive and fits the screen */
  @media (max-width: 640px) {
    .max-w-lg {
      max-width: 90%;
      height: 80vh; /* Fixed height for mobile view */
    }
    .p-6 {
      padding: 1.5rem;
    }
    .modal-content {
      max-height: 60vh; /* Scrollable content */
      overflow-y: auto;
    }
  }
  
  @media (min-width: 641px) and (max-width: 768px) {
    .max-w-lg {
      max-width: 80%;
    }
    .p-6 {
      padding: 2rem;
    }
  }
  
  @media (min-width: 769px) and (max-width: 1024px) {
    .max-w-lg {
      max-width: 70%;
    }
    .p-6 {
      padding: 2.5rem;
    }
  }
  
  @media (min-width: 1025px) {
    .max-w-lg {
      max-width: 60%;
    }
    .p-6 {
      padding: 3rem;
    }
  }
  </style>