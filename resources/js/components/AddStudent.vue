<template>
    <div>
        <h2>Adicionar Aluno</h2>
        <form @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" v-model="student.name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" v-model="student.email" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'AddStudent',
    data() {
        return {
            student: {
                name: '',
                email: ''
            }
        };
    },
    methods: {
        submitForm() {
            axios.post('/students', this.student)
                .then(() => {
                    this.$router.push('/students');
                })
                .catch(error => {
                    console.error("Erro ao adicionar aluno:", error);
                });
        }
    }
};
</script>
