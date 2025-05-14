<template>
  <Modal :show="show" @close="$emit('close')" title="Terms and Conditions">
    <div class="text-[#543434] space-y-4 max-h-[60vh] overflow-y-auto pr-2">
      <div>
        <h4 class="font-medium">1. Acceptance of Terms</h4>
        <p>By registering and using PigConnect, you agree to comply with these Terms and Conditions. If you do not agree to these terms, you are prohibited from using the platform.</p>
      </div>

      <div>
        <h4 class="font-medium">2. Eligibility</h4>
        <p>You must be at least 18 years old to use PigConnect. Users are responsible for ensuring that they comply with all applicable laws in the Philippines.</p>
      </div>

      <div>
        <h4 class="font-medium">3. User Responsibilities</h4>
        <ul class="list-disc pl-5 space-y-1">
          <li>Provide accurate and up-to-date information during registration.</li>
          <li>Maintain the confidentiality of your account details.</li>
          <li>Misuse, including providing false data or engaging in prohibited activities, may result in account termination.</li>
        </ul>
      </div>

      <div>
        <h4 class="font-medium">4. Services Provided</h4>
        <p>PigConnect provides tools for farm management, buyer-seller connections, and analytics. The platform serves as a facilitator and does not guarantee transaction outcomes.</p>
      </div>

      <div>
        <h4 class="font-medium">5. Prohibited Activities</h4>
        <ul class="list-disc pl-5 space-y-1">
          <li>Uploading offensive, illegal, or harmful content.</li>
          <li>Engaging in fraudulent activities or impersonation.</li>
          <li>Attempting to disrupt the platform or breach its security measures.</li>
        </ul>
      </div>

      <div>
        <h4 class="font-medium">6. Intellectual Property</h4>
        <p>All content, designs, and features of PigConnect are owned by PigConnect and are protected under intellectual property laws in the Philippines.</p>
      </div>

      <div>
        <h4 class="font-medium">7. Limitation of Liability</h4>
        <p>PigConnect is not responsible for losses, disputes, or damages arising from user activities or system errors. Users assume responsibility for interactions facilitated by the platform.</p>
      </div>

      <div>
        <h4 class="font-medium">8. Amendments</h4>
        <p>PigConnect reserves the right to modify these terms. Significant changes will be communicated via email or in-platform notifications.</p>
      </div>

      <div>
        <h4 class="font-medium">9. Governing Law</h4>
        <p>These Terms and Conditions are governed by the laws of the Philippines.</p>
      </div>

      <div>
        <h4 class="font-medium">10. Contact Us</h4>
        <p>For questions, email us at <a href="mailto:pigconnect.main@gmail.com" class="text-[#c58a61] hover:underline">pigconnect.main@gmail.com</a>.</p>
      </div>
    </div>
    <div class="flex justify-end mt-6">
      <button 
        @click="$emit('accept')" 
        class="bg-[#281c11] text-white px-4 py-2 rounded hover:bg-[#c59461] transition-colors"
      >
        Accept
      </button>
    </div>
  </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';

defineProps({
  show: {
    type: Boolean,
    required: true
  }
});

defineEmits(['close', 'accept']);
</script>
