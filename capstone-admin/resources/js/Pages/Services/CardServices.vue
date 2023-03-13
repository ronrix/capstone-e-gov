<template>
    <WrapperContent>
        <h1 class="font-bold text-xl mb-2">Checklist of Requirements</h1>
        <div class="grid grid-cols-2">
            <div>
                <ListReq title="Proof of Enrollment"/>
                <ListReq title="Copy of Grades of Last Semester"/>
                <ListReq title="Photocopy of School ID"/>
                <ListReq title="Barangay Clearance/ Indigency"/>
            </div>
            <div>
                <ListReq title="Letter of Request"/>
                <ListReq title="Accomplished Application Form"/>
                <ListReq title="1pc 2 x 2 Photo"/>
            </div>
            
        </div>
    </WrapperContent>
</template>

<script setup>
import ListReq from './ListReq.vue';


</script>
