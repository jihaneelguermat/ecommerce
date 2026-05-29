pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withCredentials([string(credentialsId: 'sonartoken', variable: 'SONAR_TOKEN')]) {
                    sh '''
                    docker run --rm \
                    -v "${WORKSPACE}:/usr/src" \
                    sonarsource/sonar-scanner-cli \
                    -Dsonar.projectKey=ecommerce \
                    -Dsonar.sources=/usr/src \
                    -Dsonar.host.url=http://host.docker.internal:9000 \
                    -Dsonar.login=${SONAR_TOKEN}
                    '''
                }
            }
        }

        stage('Build') {
            steps {
                echo 'Construction du projet E-commerce...'
            }
        }

        stage('Test') {
            steps {
                echo 'Lancement des tests...'
            }
        }
    }
}
