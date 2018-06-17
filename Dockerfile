ARG WEB_IMAGE
ARG BUILDER_IMAGE

FROM $BUILDER_IMAGE as app

# Install dependencies
COPY app/composer.json /app/composer.json
COPY app/composer.lock /app/composer.lock
COPY app/Build /app/Build

RUN mkdir -p /app/public/typo3conf/ext
RUN /app/Build/install-dependencies.sh


# Build the app
RUN /app/Build/build.sh

ADD app /app

# Remove build files, so they do not get copied to the app container
RUN rm -rf \
    /app/.gitignore \
    /app/composer.json \
    /app/composer.lock


FROM $WEB_IMAGE
# Add code from builder container
COPY --from=app /app /app
