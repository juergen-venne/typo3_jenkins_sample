
node('docker') {
    withCredentials([[$class: 'FileBinding', credentialsId: 'sample-jenkins-environment', variable: 'ENVIRONMENT_FILE']]) {
        stage('checkout') {
            /*
             * This script allows setting environment variables
             * via a groovy file
             *
             * See sample-jenkins-environment.env.sample for a sample file
             * This file can be added a jenkins secret file, with the above id sample-jenkins-environment
             */
            load "$ENVIRONMENT_FILE"

            def scmVars = checkout scm

            env.GIT_COMMIT = scmVars.GIT_COMMIT.substring(0,7)
            env.GIT_BRANCH = scmVars.GIT_BRANCH
            env.COMPOSE_PROJECT_NAME = "sample-${env.GIT_COMMIT}"

            sh "echo $GIT_COMMIT > app/REVISION"
        }
    }

    withCredentials([[$class: 'UsernamePasswordMultiBinding', credentialsId: env.DOCKER_REGISTRY_CREDENTIALS_ID, usernameVariable: 'DOCKER_REGISTRY_CREDENTIALS_USERNAME', passwordVariable: 'DOCKER_REGISTRY_CREDENTIALS_PASSWORD']]) {
        withDockerServer([credentialsId: env.DEMO_DOCKER_CREDENTIALS_ID, uri: env.DEMO_DOCKER_HOST_URI]) {
            stage('build') {
                sh '''
                    # Prepare docker compose file by overlaying demo specific settings
                    docker-compose -f docker-compose.yml -f docker-compose.override.demo.yml config > docker-compose.demo.yml

                    # Build builder
                    docker build -t sample_build:$GIT_COMMIT docker/build

                    # Build web
                    docker build -t sample_web:$GIT_COMMIT docker/web

                    # Build app and other service containers
                    docker-compose -f docker-compose.demo.yml build
                '''
            }

            stage('tests') {
                // Add tests here
            }

            stage('push') {
                // Workaround, as withDockerRegistry does not call 'docker login' JENKINS-41051
                sh "echo $DOCKER_REGISTRY_CREDENTIALS_PASSWORD | docker login -u $DOCKER_REGISTRY_CREDENTIALS_USERNAME --password-stdin $DOCKER_REGISTRY_URL"

                sh "docker-compose -f docker-compose.demo.yml push"
            }

            stage('up docker demo') {
                sh """
                    PROJECT=sample

                    branch_name_clean=`echo -n "\${GIT_BRANCH}" | tr -c 'a-zA-Z0-9-' '-'`
                    project_name_clean=`echo -n "\${PROJECT}" | tr -c 'a-zA-Z0-9-' '-'`
                    stackname=\${branch_name_clean}---\${project_name_clean}
                    export app_hostname=\$stackname.\${DEMO_SERVER_HOSTNAME}
                    export DEMO_SERVER_HOSTNAME=\$DEMO_SERVER_HOSTNAME

                    docker stack rm \${stackname}

                    # Wait for networks to disappear
                    until [ -z "\$(docker ps --filter label=com.docker.stack.namespace=\$stackname -q)" ]; do
                        echo "Wait for containers to disappear"
                        sleep 2;
                    done

                    until [ -z "\$(docker network ls --filter label=com.docker.stack.namespace=\$stackname -q)" ]; do
                        echo "Wait for networks to disappear"
                        sleep 2;
                    done

                    docker-compose -f docker-compose.yml -f docker-compose.override.demo.yml config > docker-compose.demo.yml
                    docker stack deploy --compose-file docker-compose.demo.yml --with-registry-auth \${stackname}
                """
            }
        }
    }
}
