<template>
    <div>
        <h2>Inscrições</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Status do Pagamento</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="enrollment in enrollments" :key="enrollment.id">
                <td>{{ enrollment.id }}</td>
                <td>{{ enrollment.student.name }}</td>
                <td>{{ enrollment.course.name }}</td>
                <td>{{ enrollment.payment_status }}</td>
                <td>
                    <router-link :to="`/enrollments/edit/${enrollment.id}`" class="btn btn-warning btn-sm">Editar</router-link>
                    <button @click="deleteEnrollment(enrollment.id)" class="btn btn-danger btn-sm">Excluir</button>
                </td>
            </tr>
            </tbody>
        </table>
        <router-link to="/enrollments/add" class="btn btn-primary">Adicionar Inscrição</router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Enrollments',
    data() {
        return {
            enrollments: []
        };
    },
    methods: {
        fetchEnrollments() {
            axios.get('/enrollments')
                .then(response => {
                    this.enrollments = response.data;
                })
                .catch(error => {
                    console.error("Erro ao buscar inscrições:", error);
                });
        },
        deleteEnrollment(id) {
            axios.delete(`/enrollments/${id}`)
                .then(() => {
                    this.fetchEnrollments();
                })
                .catch(error => {
                    console.error("Erro ao excluir inscrição:", error);
                });
        }
    },
    mounted() {
        this.fetchEnrollments();
    }
};
</script>
