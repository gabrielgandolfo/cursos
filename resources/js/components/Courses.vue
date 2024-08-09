<template>
    <div>
        <h2>Cursos</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="course in courses" :key="course.id">
                <td>{{ course.id }}</td>
                <td>{{ course.name }}</td>
                <td>{{ course.price }}</td>
                <td>
                    <router-link :to="`/courses/edit/${course.id}`" class="btn btn-warning btn-sm">Editar</router-link>
                    <button @click="deleteCourse(course.id)" class="btn btn-danger btn-sm">Excluir</button>
                </td>
            </tr>
            </tbody>
        </table>
        <router-link to="/courses/add" class="btn btn-primary">Adicionar Curso</router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Courses',
    data() {
        return {
            courses: []
        };
    },
    methods: {
        fetchCourses() {
            axios.get('/courses')
                .then(response => {
                    this.courses = response.data;
                })
                .catch(error => {
                    console.error("Erro ao buscar cursos:", error);
                });
        },
        deleteCourse(id) {
            axios.delete(`/courses/${id}`)
                .then(() => {
                    this.fetchCourses();
                })
                .catch(error => {
                    console.error("Erro ao excluir curso:", error);
                });
        }
    },
    mounted() {
        this.fetchCourses();
    }
};
</script>
