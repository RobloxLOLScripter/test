package com.trixx1.stretchres.render;

import org.joml.Matrix4f;

public class ProjectionCache {
    private static final Matrix4f CACHED = new Matrix4f();

    private static float lastFov = -1f;
    private static float lastAspect = -1f;
    private static float lastFar = -1f;

    public static Matrix4f get(float fovDeg, float aspectRatio, float farPlane) {
        if (fovDeg != lastFov || aspectRatio != lastAspect || farPlane != lastFar) {
            rebuild(fovDeg, aspectRatio, farPlane);
        }
        return new Matrix4f(CACHED);
    }

    private static void rebuild(float fovDeg, float aspectRatio, float farPlane) {
        lastFov = fovDeg;
        lastAspect = aspectRatio;
        lastFar = farPlane;

        CACHED.identity().setPerspective(
                (float) Math.toRadians(fovDeg),
                aspectRatio,
                0.05f,
                farPlane);
    }
}
