<template>
    <div>
        <h2>Editar Curso</h2>
        <form @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" v-model="course.name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Preço</label>
                <input type="number" step="0.01" class="form-control" id="price" v-model="course.price" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'EditCourse',
    props: ['id'],
    data() {
        return {
            course: {}
        };
    },
    methods: {
        fetchCourse() {
            axios.get(`/courses/${this.id}`)
                .then(response => {
                    this.course = response.data;
                })
                .catch(error => {
                    console.error("Erro ao buscar curso:", error);
                });
        },
        submitForm() {
            axios.put(`/courses/${this.id}`, this.course)
                .then(() => {
                    this.$router.push('/courses');
                })
                .catch(error => {
                    console.error("Erro ao atualizar curso:", error);
                });
        }
    },
    mounted() {
        this.fetchCourse();
    }
};
</script>
