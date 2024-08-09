<template>
    <div>
        <h2>Alunos</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="student in students" :key="student.id">
                <td>{{ student.id }}</td>
                <td>{{ student.name }}</td>
                <td>{{ student.email }}</td>
                <td>
                    <router-link :to="`/students/edit/${student.id}`" class="btn btn-warning btn-sm">Editar</router-link>
                    <button @click="deleteStudent(student.id)" class="btn btn-danger btn-sm">Excluir</button>
                </td>
            </tr>
            </tbody>
        </table>
        <router-link to="/students/add" class="btn btn-primary">Adicionar Aluno</router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Students',
    data() {
        return {
            students: []
        };
    },
    methods: {
        fetchStudents() {
            axios.get('/students')
                .then(response => {
                    this.students = response.data;
                })
                .catch(error => {
                    console.error("Erro ao buscar alunos:", error);
                });
        },
        deleteStudent(id) {
            axios.delete(`/students/${id}`)
                .then(() => {
                    this.fetchStudents();
                })
                .catch(error => {
                    console.error("Erro ao excluir aluno:", error);
                });
        }
    },
    mounted() {
        this.fetchStudents();
    }
};
</script>
