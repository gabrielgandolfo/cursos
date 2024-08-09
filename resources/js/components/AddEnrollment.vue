<template>
    <div>
        <h2>Adicionar Inscrição</h2>
        <form @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="student_id" class="form-label">Aluno</label>
                <select class="form-select" id="student_id" v-model="enrollment.student_id" required>
                    <option v-for="student in students" :value="student.id" :key="student.id">
                        {{ student.name }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="course_id" class="form-label">Curso</label>
                <select class="form-select" id="course_id" v-model="enrollment.course_id" required>
                    <option v-for="course in courses" :value="course.id" :key="course.id">
                        {{ course.name }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Cartão de Crédito</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Cartão de Crédito Validade</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Cartão de Crédito CVV</label>
                <input type="text" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'AddEnrollment',
    data() {
        return {
            enrollment: {
                student_id: '',
                course_id: '',
                payment_status: ''
            },
            students: [],
            courses: []
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
        fetchCourses() {
            axios.get('/courses')
                .then(response => {
                    this.courses = response.data;
                })
                .catch(error => {
                    console.error("Erro ao buscar cursos:", error);
                });
        },
        submitForm() {
            axios.post('/enrollments', this.enrollment)
                .then(() => {
                    this.$router.push('/enrollments');
                })
                .catch(error => {
                    console.error("Erro ao adicionar inscrição:", error);
                });
        }
    },
    mounted() {
        this.fetchStudents();
        this.fetchCourses();
    }
};
</script>
