<template>
    <div>
        <p v-if="!receiverId" style="color: red">
            Error: receiverId is undefined!
        </p>
        <p v-else>Receiver ID: {{ receiverId }}</p>

        <div v-if="receiverId">
            <Card class="chat-card">
                <template #title>Chat with User {{ receiverId }}</template>
                <template #content>
                    <ScrollPanel style="width: 100%; height: 300px">
                        <div class="messages">
                            <div
                                v-for="msg in messages"
                                :key="msg.id"
                                :class="{
                                    self: msg.sender_id === userId,
                                    other: msg.sender_id !== userId,
                                }"
                            >
                                <Message
                                    :severity="
                                        msg.sender_id === userId
                                            ? 'info'
                                            : 'secondary'
                                    "
                                    :closable="false"
                                >
                                    {{ msg.message }}
                                </Message>
                            </div>
                        </div>
                    </ScrollPanel>
                </template>

                <template #footer>
                    <div class="chat-input">
                        <InputText
                            v-model="newMessage"
                            placeholder="Type a message..."
                            class="w-full"
                            @keyup.enter="sendMessage"
                        />
                        <Button
                            icon="pi pi-send"
                            @click="sendMessage"
                            :disabled="!newMessage"
                        />
                    </div>
                </template>
            </Card>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import ScrollPanel from "primevue/scrollpanel";
import Card from "primevue/card";
import Message from "primevue/message";

// Destructure Inertia props using the composition API.
const { props } = usePage();

// Use computed properties to access the props safely.
// const receiverId = computed(() => props.receiverId);
const receiverId = ref(2);
console.log(receiverId);

const messagesFromProps = computed(() => props.messages || []);
const userId = computed(() => props.auth?.user?.id || null);

const newMessage = ref("");
const messages = ref([...messagesFromProps.value]);

const fetchMessages = () => {
    if (!receiverId.value) {
        console.error("receiverId is undefined!");
        return;
    }
    router.get(
        `/chat/${receiverId.value}`,
        {},
        {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page) => {
                messages.value = page.props.messages;
            },
        }
    );
};

// Polling every 5 seconds once the component is mounted.
onMounted(() => {
    if (receiverId.value) {
        setInterval(fetchMessages, 5000);
    }
});

const sendMessage = () => {
    if (!newMessage.value) return;
    router.post(
        "/chat/send",
        {
            receiver_id: receiverId.value,
            message: newMessage.value,
        },
        {
            preserveScroll: true,
            onSuccess: () => {
                newMessage.value = "";
                fetchMessages();
            },
        }
    );
};
</script>

<style>
.chat-container {
    max-width: 500px;
    margin: auto;
    padding: 20px;
}

.chat-card {
    padding: 10px;
}

.messages {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.self {
    align-self: flex-end;
    text-align: right;
}

.other {
    align-self: flex-start;
}

.chat-input {
    display: flex;
    gap: 10px;
}
</style>
