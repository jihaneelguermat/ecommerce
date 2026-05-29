pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Build') {
            steps {
                echo 'Construction du projet E-commerce...'
                // Ici, Jenkins pourra lancer vos commandes de build
            }
        }
        stage('Test') {
            steps {
                echo 'Lancement des tests...'
            }
        }
    }
}
