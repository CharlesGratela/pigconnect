<template>
  <Modal :show="show" @close="$emit('close')" title="Privacy Policy">
    <div class="text-[#543434] space-y-4 max-h-[60vh] overflow-y-auto pr-2">
      <div>
        <h4 class="font-medium">1. Information We Collect</h4>
        <ul class="list-disc pl-5 space-y-1">
          <li><span class="font-medium">Personal Data:</span> Includes name, email, phone number, and farm/business details.</li>
          <li><span class="font-medium">Usage Data:</span> Interaction patterns, device details, and IP address.</li>
          <li><span class="font-medium">Transaction Data:</span> Purchase history and preferences.</li>
        </ul>
      </div>

      <div>
        <h4 class="font-medium">2. How We Use Your Information</h4>
        <ul class="list-disc pl-5 space-y-1">
          <li>To provide and enhance PigConnect services.</li>
          <li>To deliver personalized recommendations and improve user experience.</li>
          <li>To notify you of updates, promotions, and system changes.</li>
        </ul>
      </div>

      <div>
        <h4 class="font-medium">3. Data Sharing</h4>
        <p>Your data will not be sold or shared with third parties unless required for:</p>
        <ul class="list-disc pl-5 space-y-1 mt-1">
          <li>Legal compliance.</li>
          <li>Service facilitation (e.g., payment processors).</li>
          <li>System improvement in anonymized and aggregated forms.</li>
        </ul>
      </div>

      <div>
        <h4 class="font-medium">4. Data Security</h4>
        <p>We implement security measures to protect your data but cannot guarantee complete security due to risks associated with online data transmission.</p>
      </div>

      <div>
        <h4 class="font-medium">5. User Rights</h4>
        <ul class="list-disc pl-5 space-y-1">
          <li>Request access, correction, or deletion of your data by contacting <a href="mailto:pigconnect.main@gmail.com" class="text-[#c58a61] hover:underline">pigconnect.main@gmail.com</a>.</li>
          <li>Opt out of receiving promotional messages.</li>
        </ul>
      </div>

      <div>
        <h4 class="font-medium">6. Cookies</h4>
        <p>Cookies are used to enhance functionality and analyze platform performance. You can manage cookie preferences through your browser.</p>
      </div>

      <div>
        <h4 class="font-medium">7. Third-Party Links</h4>
        <p>PigConnect may link to external websites. We are not responsible for their content or privacy policies.</p>
      </div>

      <div>
        <h4 class="font-medium">8. Amendments</h4>
        <p>This policy is subject to updates. Changes will be notified via email or system announcements.</p>
      </div>

      <div>
        <h4 class="font-medium">9. Contact Us</h4>
        <p>For privacy-related inquiries, email us at <a href="mailto:pigconnect.main@gmail.com" class="text-[#c58a61] hover:underline">pigconnect.main@gmail.com</a>.</p>
      </div>
    </div>
    <div class="flex justify-end mt-6">
      <button 
        @click="$emit('close')" 
        class="bg-[#281c11] text-white px-4 py-2 rounded hover:bg-[#c59461] transition-colors"
      >
        Close
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

defineEmits(['close']);
</script>
