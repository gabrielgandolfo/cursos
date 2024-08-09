<template>
    <div>
        <h2>Editar Inscrição</h2>
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
                <label for="payment_status" class="form-label">Status do Pagamento</label>
                <input type="text" class="form-control" id="payment_status" v-model="enrollment.payment_status" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'EditEnrollment',
    props: ['id'],
    data() {
        return {
            enrollment: {},
            students: [],
            courses: []
        };
    },
    methods: {
        fetchEnrollment() {
            axios.get(`/enrollments/${this.id}`)
                .then(response => {
                    this.enrollment = response.data;
                })
                .catch(error => {
                    console.error("Erro ao buscar inscrição:", error);
                });
        },
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
            axios.put(`/enrollments/${this.id}`, this.enrollment)
                .then(() => {
                    this.$router.push('/enrollments');
                })
                .catch(error => {
                    console.error("Erro ao atualizar inscrição:", error);
                });
        }
    },
    mounted() {
        this.fetchEnrollment();
        this.fetchStudents();
        this.fetchCourses();
    }
};
</script>
