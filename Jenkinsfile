pipeline {
    // On utilise l'image officielle Maven pour tout le pipeline
    agent {
        docker {
            image 'maven:3.8.6-openjdk-17'
        }
    }
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withCredentials([string(credentialsId: 'sonartoken', variable: 'SONAR_TOKEN')]) {
                    // On exécute le scan via un conteneur éphémère
                    sh '''
                    docker run --rm \
                    -v "${WORKSPACE}:/usr/src" \
                    sonarsource/sonar-scanner-cli \
                    -Dsonar.projectKey=ecommerce \
                    -Dsonar.sources=/usr/src \
                    -Dsonar.host.url=http://192.168.1.15:9000 \
                    -Dsonar.login=${SONAR_TOKEN}
                    '''
                }
            }
        }

        stage('Build') {
            steps {
                // Maintenant, 'mvn' est disponible grâce à l'image 'maven:3.8.6'
                sh 'mvn clean package -DskipTests'
            }
        }

        stage('Test') {
            steps {
                sh 'mvn test'
            }
        }
    }
}
